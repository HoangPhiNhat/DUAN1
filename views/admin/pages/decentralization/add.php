<div class="col-12 grid-margin stretch-card h-100">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm Vai Trò</h4>
            <form action="/DUAN1/index.php?controller=admin&action=addroles" method="POST" class="forms-sample" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="name">Tên Vai Trò</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên vai trò" required >
                  
                </div>
                <button type="submit" name="submitUpdateroles" class="btn btn-gradient-primary me-2" >Submit</button>
                <button class="btn btn-light">
                    <a href="index.php?controller=admin&action=rolesListAdmin">Cancel</a>
                </button>
            </form>
        </div>
    </div>
</div>
