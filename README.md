----------------------------Directory structure set up-------------------------------
In your server make a folder called [handy_mama_api] or whatever you want
download the content from https://github.com/neloy-ahmed/handy_mama_test

place them inside [handy_mama_api]
-----------------------------------------------------------

---------------------------Database set up--------------------------------
in your hosting set up the mysql database. You can configure database credentials in require/config.php file.

in your database import the given sql file. There is only a single table named [order_specification]
this table name should be as it is.

-----------------------------------------------------------

----------------------------Client/form setup-------------------------------

In the give [handy_mama_form.html] set the API url as action.

it shoud be http://yoursite.com/handy_mama_api/v1/call_handy_mama



-----------------------------------------------------------
