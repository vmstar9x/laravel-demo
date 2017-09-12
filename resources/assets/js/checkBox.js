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
