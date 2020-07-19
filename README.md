<h1 align="center">Software Engineer - Coding challenge</h1>


## About

This application is a demo app for the coding challenge provided by Nextmedia to evaluate the coding skills of developers and software engineers.


## Deploying

To deploy the demo app on a docker container just run from inside the project folder:
- `chmod +x build.sh`
- `./build.sh`

That's it, now the images will start building and then deploying to a container.

# Usage

## Command Line:
### Create and Delete Categories.
@ To create a new category that has a parent relation run this command:
- `php artisan category:create CATEGORY_NAME CATEGORY_PARENT_ID`

@ To create a new category without a parent relation run this command: 
- `php artisan category:create CATEGORY_NAME`

@ To delete a category run this command:
- `php artisan category:delete CATEGORY_ID`

@ To delete many categories in a single command run this command:
- `php artisan category:delete CATEGORY_ID1 CATEGORY_ID2 CATEGORY_ID3...`

### Create and Delete Products.
@ To create a new product run this command:
- `artisan product:create --name=NAME --description=DESCRIPTION --price=PRICE --category_id=CATEGORY_ID --image="/FULL/PATH/TO/IMAGE.EXT"`

@ To delete an existing product(s):
- `artisan product:delete PRODUCT_ID`

@ To delete many existing products:
- `artisan product:delete PRODUCT_ID1 PRODUCT_ID2 PRODUCT_ID3...`

## Web Interface
### Show Product List
#### Important
@ If you followed the instructions above to deploy this demo you can access the web interface using the IP address of the web container, the default IP address is `172.13.37.10`.
so to access it in the browser open.
- `http://172.13.37.10`

@If you are using Windows or MacOS you cannot access the container using the containers local ip address.
- check the docker documentation for how to access the container from Windows or MacOS 

#### Sorting and filtering product list
@ in the table of products you can sort products by name and by price
- Click on the name or price header column to sort

@ int the field above the table you can filter the products by category.
- click on select box above products table and select the category you want to filter by
- filtering and sorting are working fine together you can sort by price then filter by category and sorting will keep working after table reload   


### Create a new product
@ To create a new product click on NEW ITEM button in the top left of the table, a modal will pop up to fill the form and submitted
 
