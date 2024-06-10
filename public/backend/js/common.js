function previewImage(input, element) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById(element).src = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}
