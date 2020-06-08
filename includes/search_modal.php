<style>
    .Search_model{
        position: absolute;
        top: 67.0739px;
        height: auto;
        min-height: 400px;
        border: 1px solid #eee;
        background: #fff;
        z-index: 100000;
        display: none;
    }

    #products{
        height: 100vh;
        overflow-y: scroll;
        width: 100%;
        margin: auto;
    }
</style>

<div class="Search_model" id="search__Modal__ID">
    <div class="card border-0 py-3">
        <!-- <div class="btn-group">
            <a id="list" class="">
                <span class="glyphicon glyphicon-th-list">
            </span></a> <a  id="grid" class=""><span
                class="glyphicon glyphicon-th"></span></a>

        </div> -->
        <div class="float-right">
            <!-- <a href="#" class="btn btn-outline-dark bg-warning text-decoration-none text-white">View All</a> -->
            <img src="https://img.icons8.com/material/24/000000/delete-sign--v1.png" class="close">
        </div>
    </div>
    
    <div id="products" style="overflow-x: hidden;" class="row"></div>
</div>
