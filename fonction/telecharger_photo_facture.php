 <?php
/* Getting file name */
$filename = $_FILES['file']['name'];
$idfacture=$_GET['idfacture'];
/* Location */
$location = "../image/facture/".$idfacture.".jpg";
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
/* Valid Extensions */
$valid_extensions = array("jpg","jpeg");
/*Check file extension*/ 
if( !in_array(strtolower($imageFileType),$valid_extensions)) {
  $uploadOk = 0;
};
 if($uploadOk == 0){
  echo 0;
}else{
  /* Upload file */
  if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
      echo 1;
   }else{
      echo 0;
   }
}