<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of apiServer
 *
 * This api for OSClass 3.3.2
 * 
 */
class apiServer {

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

    /**
     * @url GET /country
     * @url GET /country/$code
     */
    public function getCountry($code) {
        if ($code) {
            return(CountryStats::newInstance()->findByCountryCode($code));
        }

        return(CountryStats::newInstance()->listCountries(">="));
    }

    /**
     * List region by country code
     * 
     * @url GET /country/$code/region
     */
    public function getRegionbyCountry($code) {
        if ($code) {
            return( Region::newInstance()->findByCountry($code));
        }

        return array();
    }

    /**
     * GET City and States by city Id
     * List city by region id
     * 
     * @url GET /region/$regionid/city
     */
    public function getCityListbyRegion($regionid) {
        if ($regionid) {
            //GET:return single city and states
            return(CityStats::newInstance()->listCities($regionid, ">=", $order = "city_name ASC"));
        }

        return array();
    }

    /**
     * Get city by city id
     *  
     * @url GET /city/$cityid
     */
    public function getCity($cityid) {
        if ($cityid) {
            //GET:return single city and states
            return( CityStats::newInstance()->findByCityId($cityid));
        }
        return array();
    }

    /**
     * Get Category all lang
     * list all or single by categoryid
     * 
     * @url GET /category
     * @url GET /category/$id
     */
    public function getCategory($id) {
        if($id){
           return(RestCategory::newInstance()->findByPrimaryKeyGlobal($id)); 
        }
        
        return(RestCategory::newInstance()->restListEnableGlobal());
    }

    /**
     * GET Category
     * 
     * @url GET /categorylang/$lang
     */
    public function getCategorylang($lang) {
        if ($lang) {
            return(RestCategory::newInstance()->restListEnabled($lang));
        }
        
        return array();       
    }

    /**
     * GET items by category
     * 
     * @url GET /category/$categoryid/items     * 
     */
    public function getItemsbyCategory($categoryid ){
        return(Item::newInstance()->findByCategoryID($categoryid));
        
    }

    /**
     * GET Item by Id
     *
     * @url GET /item/$id
     */
    public function getItem($id) {
        if ($id) {
            return (Item::newInstance()->findByPrimaryKey($id));
        }

        return array();
    }

    /**
     * @url GET /item/$id/msg
     */
    public function getItemMsg($id) {
        return array();
    }

    /**
     * Search
     * 
     * @url POST /search/item
     */
    public function postItemSearch(){
        $id = $_POST['id'];
        $category = $_POST['category'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $lang = $_POST['lang'];
        
        $counter = 0;
        
        $mSearch = new Search();
        
        if($id){
            $mSearch->addItemId($id) ;
            $counter++;
        }
        
        if($category){
            if($mSearch->addCategory($category)) $counter++ ;
        }
        
        if($counter == 0){
            return FALSE;
        }
        
        $items = $mSearch->doSearch(FALSE,TRUE);
        
        return ($items);
        
    }
}
