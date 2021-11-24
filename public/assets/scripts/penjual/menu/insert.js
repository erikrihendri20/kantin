$(document).ready( () => {
    $('#photo').change( (e) => {
        file = $(e.target).get(0).files[0]
        if(file){
            var reader = new FileReader()
            reader.onload = function() {
                $('#preview-photo').attr('src' , reader.result)
            }
            reader.readAsDataURL(file)
        }
    } )
} )