<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
    </button>
        <a class="navbar-brand" href="#">LISNepal</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="active"><button type="button" class="btn" id="staff_list">Users</button></li>
            <li class="active"><button type="button" class="btn" id="skill_list">Skills</button></li>
            <li class="active"><button type="button" class="btn" data-toggle="modal" data-target="#userModal" >Add Users</button></li>
            <li class="active"><button type="button" class="btn" data-toggle="modal" data-target="#categoryModal" >Add SKills</button></li>
        </ul>
        <div class="col-sm-3 col-md-3">
            <form class="navbar-form" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="q">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- /.navbar-collapse -->
</nav>
