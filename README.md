I want to develop a mobile app for osclass. I need a api server. But I did not find. 
I think osclass need a API server. So I built this project.

This is a  PHP REST API server for osclass. It is a very light-weight, easy to set up and get going. 
It is base on a very nice open source project, a rest server framework: jacwright/RestServer
https://github.com/jacwright/RestServer

Easy to set up.

1. Create named api(or other name) folder in osclass folder.
2. Copy all files to api folder.
3. Run.

Easy to use:

Examples:

1.Get category list, include all language.

  	http://localhost/osclass.3.3.2/api/v0.1/category or {hoemeurl}/api/v0.1/category
	
2.Get a category detail, category id = 9 

  	http://localhost/osclass.3.3.2/api/v0.1/category/9
	
3.Get all items list in category id = 9	

   	http://localhost/osclass.3.3.2/api/v0.1/category/9/items

4.Get item detail,item id = 1

 	http://localhost/osclass.3.3.2/api/v0.1/item/1

Easy to develop:

The below code implements two query functions:

1. get all enable locale list

	url: {homeurl}/api/v0.1/locale

2. get locale detail, locale code = ??? 

	url: {homeurl}/locale/zh_CN

Code:

/**
* Return all locales enabled.
* 
* Call OSClocale
* function listAllEnabled($isBo = false, $indexedByPk = false)
* 
* @url GET /locale
* @url GET /locale/$code
*/

public function getLocale($code) {
if ($code) {
    $result = OSCLocale::newInstance()->findByCode($code);
} else {
    $result = OSCLocale::newInstance()->listAllEnabled();
}

return ($result);
}

The current version is only a start. Completed a few functional for most query.
Next, This API server, ARestAPI4OSClass, need a REST API Authorization & Authentication, and finish PUT, DELETE, etc. for EDIT or DELETE data.

I hope to get your help to complete these tasks. I also hope you can understand my bad English.

 

