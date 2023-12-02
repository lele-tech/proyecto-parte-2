<?php
    require_once '../database.php';
    
    include('simple_html_dom.php');
    /*
    LIBANO
    https://www.allrecipes.com/recipes/1824/world-cuisine/middle-eastern/lebanese/

    ALEMANIA
    https://www.allrecipes.com/recipes/722/world-cuisine/european/german/

    INDIA
    https://www.allrecipes.com/recipes/17136/world-cuisine/asian/indian/main-dishes/
    https://www.allrecipes.com/recipes/15935/world-cuisine/asian/indian/drinks/

    MEXICO
    https://www.allrecipes.com/recipes/728/world-cuisine/latin-american/mexican/
    https://www.allrecipes.com/recipes/15936/world-cuisine/latin-american/mexican/drinks/

    JAPON
    https://www.allrecipes.com/recipes/699/world-cuisine/asian/japanese/

    CHINA
    https://www.allrecipes.com/recipes/695/world-cuisine/asian/chinese/

    COREA
    https://www.allrecipes.com/recipes/700/world-cuisine/asian/korean/

    ITALIA
    https://www.allrecipes.com/recipes/1789/world-cuisine/european/italian/authentic/
    https://www.allrecipes.com/recipes/17551/world-cuisine/european/italian/drinks/

    FRANCIA
    https://www.allrecipes.com/recipes/721/world-cuisine/european/french/

    ESPAÑA
    https://www.allrecipes.com/recipes/726/world-cuisine/european/spanish/

    NORDICA
    https://www.allrecipes.com/recipes/1892/world-cuisine/european/scandinavian/danish/

    GENERIC DRINKS 
    https://www.allrecipes.com/recipes/77/drinks/

    */

    //link
    $link = "https://www.allrecipes.com/recipes/77/drinks/";

    $filenames = [];
    $menu_item_names = [];
    $menu_item_descriptions = [];
    $image_urls = [];

    $menu_items = 6;

    $items = file_get_html($link);

    //save meals info and filenames for the images
    foreach ($items->find('.card--no-image') as $item){
        
        $title = $item->find('.card__title-text');
        
        $details = file_get_html($item->href);
        $description = $details->find('.article-subheading');
        $image = $details->find('.primary-image__image');

        if(count($image) > 0){
            $image_urls[] = $image[0]->src;
        }else{
            $replace_img = $item->find('.universal-image__image');
            if(count($replace_img) > 0){
                $image_urls[] = $replace_img[0]->{'data-src'};
            }
        }
       
        if(count($description) > 0){
            if($menu_items == 0) break;

            $menu_item_names[] = trim($title[0]->plaintext);
            $menu_item_descriptions[] = $description[0]->plaintext;
            
            $filename = strtolower(trim($title[0]->plaintext));
            $filename = str_replace(' ', '-', $filename);
            $filenames[] = $filename;

            $menu_items--;
        }

    }

    foreach($filenames as $index=>$item){
        echo "******************";
        echo "<br>";
        echo $item;
        echo "<br>";
        echo $menu_item_names[$index];
        echo "<br>";
        echo $menu_item_descriptions[$index];
        echo "<br>";
        echo $image_urls[$index];
        echo "<br>";
        echo rand (1*10, 70*10)/10;
        echo "<br>";
        
        //recordar que se movio la ruta donde se almacenan las imagenes

       /* $menu_items--;
        if($menu_items == 0) break;
        $database->insert("tb_recipes",[
            "recipe_name"=> $menu_item_names[$index],
            "recipe_image"=> $item.'.jpg',
            "id_category"=> 2,
            "recipe_description"=> $menu_item_descriptions[$index],
            "recipe_price"=> rand (1*10, 70*10)/10,
            "id_number_people"=> 2,
            "featured_recipe"=> 0,
        ]);*/
    }

    //get and download images
    /*foreach ($filenames as $index=>$image){
        file_put_contents("./images/".$image.".jpg", file_get_contents($image_urls[$index]));
    }*/

    //insert info
    // Reference: https://medoo.in/api/insert
    /*$database->insert("tb_name",[
        "field"=> value,
        "field"=> value
    ]);*/
    

?>