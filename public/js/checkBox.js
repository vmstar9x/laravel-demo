$(document).ready(function() {
    $("#checkAll").click(function() {
		
        if (this.checked) {
            $('.case').each(function() {
                this.checked = true;
            });
        } else {
            $('.case').each(function() {
                this.checked = false;
            });
        }
    });
});
function ask(){
    if (confirm("Bạn có chắc chắn muốn xóa thông tin này không ?")) return true;
    return false ;
}