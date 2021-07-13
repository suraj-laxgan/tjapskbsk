<style>
    .form-controls {
    /* height: calc(2.4rem + 2px); */
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    width: 100%;
    padding: 2px;
    font-size: 12px;
    line-height: 1.5;
    color: #495057;
    display: block;
    /* border-radius: 10px; */
    /* border: 1px solid #ced4da; */
    outline: none;
    }
    .body_link_text {
    position: absolute;
    top: 5px;
    left: 30px;
    font-size: 12px;
    font-weight: 500;
    color: rgb(100,100,100);
    }
    .body_circle_icon {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background-color: #00c0ff;
    text-align: center;
    vertical-align: middle;
    padding-top: 5px;
    color: #FFFFFF;
}
.fa, .fas {
    font-weight: 900;
}
.fa, .far, .fas {
    font-family: "Font Awesome 5 Free";
}
.fa, .fab, .fal, .far, .fas {
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
}
.header1{
    
  /* border: 2px solid #9999e6; */
  background-color:white;
  border-bottom: 2px solid rgb(207, 207, 245);
  padding: 3px;
  /* border-radius: 25px; */
  /* margin-left:-8px; */
}
.button22 
    {
        padding: 3px 3px ;
        /* border-radius: 20px; */
        border: 1px solid #323fff;
        text-decoration: none;
        background: none;
        cursor: pointer;
    }
    #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 3px;
    
    }

    #customers tr:nth-child(even){background-color: #e6e6e6;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
    padding-top: 3px;
    padding-bottom: 3px;
    text-align: center;
    background-color: #00c0ff;
    color: white;
    }

</style>
<div class="row">
    <div class="header1 col-md-12">
        <span style="position:relative;width:120px ">
            <div class="body_circle_icon fas fa-ellipsis-v"></div>
            <a href="{{ route('admin.state') }}" class="body_link_text {{ request()->is('admin-state') ? 'ad_active_manu':'' }}" style="text-decoration:none;">Add State</a>
            <!-- <i class="fas fa-ellipsis-v icon_size" style="position:absolute; top:0px; left:0px;"></i> -->
        </span>
        <span style="position:relative;width:120px">
            <div class="body_circle_icon fas fa-cubes"></div>
            <a href="{{ route('admin.state-view') }}" class="body_link_text {{ request()->is('admin-state-view') ? 'ad_active_manu':'' }} " style="text-decoration:none;">View State</a>
        </span>
    </div>
</div> 