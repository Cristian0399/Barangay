<?php  
session_start(); 

  
if(!$_SESSION['admin_name'])  
{  
   header("Location: adminlogin.php"); 
}  
?>
<html>  
<head lang="en">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="font-awesome/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet"> 
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery.min.js"></script>
    
 
    <title>Mainform</title>  
</head>  
<style>  
    body{
      /*font-family: "Lato", sans-serif;*/
      overflow-x: hidden; 
    }
   
    input.hide-button{
      width: 0px;
      height: 0px;
      border: none;
    }
    input.search-input {
      padding: 5px 30px 5px 30px;
      border-radius: 100px;
      border: 1px solid gray;
    }
    img.search{
      width: 20px;
      height: 20px;
      margin-left: -30px;
    }
  /*  #banner{
      padding: 0px;
    }*/
    .controls{
      background-color: #BDC0C9;
      padding: 15px;
      height: 200vh;
      width: 300px;
    }
    .hi{
      margin-top: 20px;
    }
    .margin-top-50{
      margin-top: 20px;
    }
    .right-section{
     /* padding-top: 121px;*/
      padding-left: 0px;
      padding-right: 0px;
    }
    .gray{
      margin-bottom: 10px;
      border-outline: black;
    }
    .action-buttons{
      padding: 10px;
      margin-bottom: 20px;
    }
    .pagination-number{
      width: 80px;
    }
    .records{
      margin-top: 1px;
    }
    .staffrecords{
      margin:10px;
    }
    .records input{
      width: 250px;
    /*  border-radius: 2px;*/
      box-shadow: 1px 2px 2px gray;
      margin-bottom: 10px;
    }
    .choices{
      padding: 20px 20px 0px 20px;
    }
   .camera{
      padding: 5px;
      margin-bottom: 18px;
      border-radius: 1px;
    }
    .picture{
    margin-bottom: 10px;
    height: 200px;
    width: 250px;
    background-color:darkgray;
    border-radius: 1px;
    }
   .picture2{
    height: 150px;
    width: 150px;
    padding-top: 20px;
    }
    .image{
      border-radius: 1px;
      height: 40px;
      width: 40px;
    }
    /* Style The Dropdown Button */
    .dropdown-container {
    display: none;
    background-color: #262626;
    padding-left: 15px;
    border-radius: 8px;
    padding: 10px;
    color: black;
    }
    /* Optional: Style the caret down icon */
    .fa-caret-down {
    float: right;
    }
    button.dropdown-btn{
        background: transparent;
        border: none;
    }
    #Anthony{
      font-size: 45px;
      padding: 25px;

    }
    .tittle-header{
      background-color: #777C7D;
      margin-top: 19px;
      font-family: Lucida Fax;
      color: white;
      padding: .5px 0px 20px 10px;
      border-bottom: 5px solid black;
    }
    #BR{
      color: black;
    }
    #S{
      color: black;
    }
    .jheader{
      background-color: black;
      color: white;
    }
    .modal-header .close {
      margin-top: -2px;
      color: red;
      font-size: 2em;
    }
    .red{
      color: red;
      border: none;
      background: transparent;
    }
    .red:hover{
       text-decoration: underline;
    }
    .modal-body{
      padding-bottom: 50px;
    }
    img.img-officials{
      width: 80px;
      height: 80px;
      border-radius: 1px;
    }
    .no-background{
      border:none;
    }
    .adminauth{
      position: flex;
      right: 100px;
      top: 147px;
      font-family: Berlin Sans FB;
      letter-spacing: 3px;
      font-size: 1.5em;
      display: inline-flex;
    }
    .text-admin{
      font-family: Lucida Fax;
    }
    .board1{
      border-radius: 10px;
      border: 1px solid gray;
      border-left: 10px solid green;
      margin-top: 20px;
    }
     .board2{
      border-radius: 10px;
      border: 1px solid gray;
      border-left: 10px solid blue;
      margin-top: 20px;
    }
     .board3{
      border-radius: 10px;
      border: 1px solid gray;
      border-left: 10px solid red;
      margin-top: 20px;
    }
    .text-center.info {
    background-color: gray;
    height: 50px;
    padding-top: 0.5px;
    font-family: Lucida Fax;
    font-weight: bold;
    font-size: 3em;
    color: white;
  }
  .inside{
    background-color: mintcream;
  }
  .barangayofficials{
    overflow: scroll;
  } 
  .ai{
    background-color: gray;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 60px;
    padding-top: 9px;
    font-family: Stylus BT;
    font-weight: bold;
    font-size: 1.5em;
    margin-top: -1px;;
    letter-spacing: 1px;
    color: white;
  }
  .g1{
    border-style: groove;
    width: 31%;
    background-color: mintcream;
  }
  .container.aii{
    margin-top: 45px;
    margin-top:45px;
    position:absolute;
    left: 34%;
  }
  tbody>tr:hover{
   background-color: #e6e1b79e;
  }
  thead{
    background-color: #cbc378bf;
    color: #140f04;
  }
  .files-text{
      font-family: georgia;
      color:black;
      letter-spacing: 2px;
  }
  .search-input{
    padding: 2px 20px 2px 20px;
    border-radius: 5px;
    border: 1px solid gray;
  }
  .flex2{
    padding-top: 15px;
    padding-bottom: 5px;
    width: 500px;
  }
  .hhh{
    padding: 2px 20px 2px 20px;
    border-radius: 10px;
    border: 1px solid black;
  }
  }
  .count{
    color: green;
  }
  img.image-officials{
    width: 100px;
    height: 100px;
    border-radius: 1px;
  }
  .img-responsive{
    padding-top: 31px;
  }
</style>