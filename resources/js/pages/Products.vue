<template>
    <v-card>
    <v-card-title>
        Products
        <v-spacer/>
        <v-select
            v-model="select"
            :items="categoriesList"
            label="Categories"
            outlined
            clearable
            item-value="name"
            item-text="name"
            single-line
        />
    </v-card-title>
    <v-data-table
        :headers="headers"
        :items="products"
        :options.sync="options"
        :server-items-length="totalDesserts"
        :loading="loading"
        :single-expand="singleExpand"
        :expanded.sync="expanded"
        show-expand
        item-key="id"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="primary"
                            dark
                            class="mb-2"
                            v-bind="attrs"
                            v-on="on"
                        >New Item</v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                        </v-card-title>

                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="12" md="12">
                                        <v-text-field v-model="editedItem.name" label="Product name"/>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12" sm="12" md="12">
                                        <v-text-field :type="'number'" v-model="editedItem.price" label="Price ($)"/>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12" sm="12" md="12">
                                        <v-select
                                            :items="categoriesList"
                                            item-text="name"
                                            item-value="id"
                                            label="Category"
                                            single-line
                                            v-model="editedItem.category_id"
                                        />
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12" sm="12" md="12">
                                        <v-file-input
                                            v-model="editedItem.image"
                                            :rules="imageRules"
                                            accept="image/*"
                                            show-size
                                            filled
                                            prepend-icon="mdi-camera"
                                            placeholder="Pick an image"
                                            label="Image"/>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12" sm="12" md="12">
                                        <!--<v-text-field v-model="editedItem.description" label="Description"></v-text-field>-->
                                        <v-textarea
                                            outlined
                                            label="Description"
                                            v-model=editedItem.description
                                        />
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                            <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
        </template>
        <template v-slot:expanded-item="{ headers, item }">
            <td :colspan="headers.length">
            <v-row align="center" justify="center">
                <v-img
                    :src="item.image"
                    aspect-ratio="1"
                    class="grey lighten-2 align-content-center"
                    max-width="600"
                    min-width="300"
                    max-height="300"
                    min-height="300"
                    contain
                >
                    <template v-slot:placeholder>
                        <v-row
                            class="fill-height ma-0"
                            align="center"
                            justify="center"
                        >
                            <v-progress-circular indeterminate color="grey lighten-5"/>
                        </v-row>
                    </template>
                </v-img>
            </v-row>
            </td>
        </template>
    </v-data-table>
    </v-card>
</template>

<script>
    export default {
        name: "Products",
        data () {
            return {
                totalDesserts: 0,
                loading: true,
                select: '',
                dialog: false,
                categoriesList: [],
                defaultCatList: [],
                options: {},

                expanded: [],
                singleExpand: false,
                imageRules: [
                    value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
                ],
                headers: [
                    {
                        text: 'Product Name',
                        align: 'start',
                        sortable: true,
                        value: 'name',
                    },
                    { text: 'Description', value: 'description', sortable: false},
                    { text: 'Price ($)', value: 'price', sortable: true },
                    { text: 'Category', value: 'category', sortable: false },
                ],
                products: [],
                editedIndex: -1,
                editedItem: {
                    name: '',
                    price: undefined,
                    category_id: 0,
                    image: undefined,
                    description: '',
                },
                defaultItem: {
                    name: '',
                    price: undefined,
                    category_id: 0,
                    image: undefined,
                    description: '',
                },
                formTitle: "New Product",
            }
        },
        watch: {
            pagination: function () {
                this.getDataFromApi(this.select, null);
            },
            select: function () {
                console.log('dddddddddddddd');
                this.getDataFromApi(this.select);
            },
            options: {
                handler () {
                    this.getDataFromApi(this.select)
                },
                deep: true,
            },
            dialog (val) {
                val || this.close()
            },
        },
        mounted () {
            this.getCategoriesList();
            this.getDataFromApi();
        },
        methods: {
            getDataFromApi (filter = null, pagination = null) {
                this.loading = true;
                const { sortBy, sortDesc, page, itemsPerPage } = this.options;
                let params = {};

                if (filter !== null && filter.length > 2) {
                    params.filter_by = filter;
                }
                if (sortBy.length === 1 && sortDesc.length === 1) {
                    if (sortDesc[0]) {
                        params.sort = sortBy[0];
                        params.sort_type = 'desc';
                    } else {
                        params.sort = sortBy[0];
                        params.sort_type = 'asc';
                    }
                }
                if (itemsPerPage > 0) {
                    params.page = page;
                    params.limit = itemsPerPage;
                }
                console.log(params);
                return axios.get('/api/products', {
                        params: params
                    }) .then((response) => {
                    console.log(response.data.data);
                    const { sortBy, sortDesc, page, itemsPerPage } = this.options;

                    let items = response.data.data;
                    if (itemsPerPage > 0) {
                        items = items.slice((page - 1) * itemsPerPage, page * itemsPerPage)
                    }
                    this.products = items;
                    this.totalDesserts = response.data.data.length;
                    this.loading = false
                });;

            },
            getCategoriesList() {
                axios.get('/api/categories/list') .then((response) => {
                    console.log(response.data.data);
                    this.categoriesList = response.data.data;
                });
            },

            editItem (item) {
                this.editedIndex = this.products.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },
            close () {
                this.dialog = false
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                })
            },

            save () {
                if (this.editedIndex > -1) {
                    Object.assign(this.products[this.editedIndex], this.editedItem)
                } else {
                    let formData = new FormData();
                    formData.append("name", this.editedItem.name);
                    formData.append("price", this.editedItem.price);
                    formData.append("category_id", this.editedItem.category_id);
                    formData.append("description", this.editedItem.description);
                    formData.append("image", this.editedItem.image);

                    axios.post('/api/products', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then((response) => {
                        console.log(response);
                        this.getDataFromApi(this.select)
                        //console.log(response.status)
                    }).catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    this.products.push(this.editedItem)
                }
                this.close()
            },
            filterByCategoryName(value, search, item) {
                console.log('value: '.value)

            }

        },
    }
</script>

<style scoped>

</style>
