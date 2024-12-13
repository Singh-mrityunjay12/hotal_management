<script>

$(document).ready(function(){
         //iska use karake CSRF-TOKEN ka error remove karate h 
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

            });



              // newsletter
        $('#news').on('submit', function(e){
            e.preventDefault();
            let data = $(this).serialize();   //serialize is used to access all of the data from the form
            
            // alert('hello');
            $.ajax({
                method: 'POST',
                url: "{{route('newsletter-request')}}",
                data: data,
                // beforeSend: function(){
                //     $('.subscribe_btn').text('Loading...');
                // },
                success: function(data){
                    // if(data.status === 'success'){
                    //     $('.subscribe_btn').text('Subscribe');
                    //     $('.newsletter_email').val('');
                    //     toastr.success(data.message);

                    // }else if(data.status === 'error'){

                    //     $('.subscribe_btn').text('Subscribe');
                    //     toastr.error(data.message);

                    
                    // }
                },
                error: function(data){
                    // let errors = data.responseJSON.errors;
                    // if(errors){
                    //     $.each(errors, function(key, value){
                    //         toastr.error(value);
                    //     })
                    // }
                    // $('.subscribe_btn').text('Subscribe');
                    console.log(data);
                }
            })
            
    
    
        })



});


</script>