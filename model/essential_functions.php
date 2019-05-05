 <?php 

$upload_directory = "uploads";

function display_image($picture) {

global $upload_directory;

return $upload_directory  . DS . $picture;

}


function set_message($msg){
if(!empty($msg)) {

$_SESSION['message'] = $msg;

} else {

$msg = "";


    }


}


function display_message() {

    if(isset($_SESSION['message'])) {

        echo $_SESSION['message'];
        unset($_SESSION['message']);

    }
}


function redirect($location){

return header("Location: $location ");

}