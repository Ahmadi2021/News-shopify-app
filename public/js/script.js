

var request; 

// Popup 
$(function() {
//   ________________________________Create News

    $(document).on('submit','#create_news',function(event){
        // $('#create_news').submit(function(event){
           event.preventDefault();
           $formData =  new FormData($('#create_news')[0]);
           $('.success').html('');
           $('.error ul').html('');
       request =  $.ajax({
            type:'post',
            url:'/store',
            contentType:false,
            processData:false,
            dataType:'json',
            async:false,
            data:$formData,
            success:function(response){
              console.log(response);
              $('html, body').animate({scrollTop:0}, 'slow');
              message = '<div class="alert success">'
              message+= '<dl>'
              message+= '<dt>Successfully Created</dt>'
              message+= '</dl></div>'
              $('.success').html(message);
              
            //   $('#create_news')[0].reset();
            },
            error(err){
                console.log(err);
                $('.error ul').removeClass('d-none');
                if(err.responseJSON.errors.title){
                    $('.error .title').append('<li>*'+err.responseJSON.errors.title+'</li>');
                }
                if(err.responseJSON.errors.description){
                    $('.error .description').append('<li>*'+err.responseJSON.errors.description+'</li>');
                }
                if(err.responseJSON.errors.image){
                    $('.error .image').append('<li>*'+err.responseJSON.errors.image+'</li>');
                }
            }
        }).done(function(){
            // console.log('in request null');
            request = null;
        });
    });

    // ________________________________Updated News

    $(document).on('submit','#update_news',function(event){
        // $('#create_news').submit(function(event){
           event.preventDefault();
           $formData =  new FormData($('#update_news')[0]);
           $('.success').html('');
           $('.error ul').html('');
           var id = $('.news_id').attr('value');
          
        $.ajax({
            type:'post',
            url:'/news/'+id,
            contentType:false,
            processData:false,
            dataType:'json',
            data:$formData,
            async:false,
            success:function(response){
              console.log(response);
              $('html, body').animate({scrollTop:0}, 'slow');
              message = '<div class="alert success">'
              message+= '<dl>'
              message+= '<dt>Successfully Updated</dt>'
              message+= '</dl></div>'
              $('.success').html(message);
              
            //   $('#create_news')[0].reset();
            },
            error(err){
                console.log(err);
                $('.error ul').removeClass('d-none');
                if(err.responseJSON.errors.title){
                    $('.error .title').append('<li>*'+err.responseJSON.errors.title+'</li>');
                }
                if(err.responseJSON.errors.description){
                    $('.error .description').append('<li>*'+err.responseJSON.errors.description+'</li>');
                }
                if(err.responseJSON.errors.image){
                    $('.error .image').append('<li>*'+err.responseJSON.errors.image+'</li>');
                }
            }
        });
    });

    // ____________________________________________Delete News

    $(document).on('click','.delete_form',function(event){
        event.preventDefault();
        $('.success').html('');
        var id = $('.id').attr('value');
        if(confirm('Are You sure Delete item?')){
            $.ajax({
                type:'delete',
                url:'/news/'+id,
                processData:false,
                contentType:false,
                dataType:'json',
                success:function(response){
                    console.log(response);
                    $('html, body').animate({scrollTop:0}, 'slow');
                    message = '<div class="alert success">'
                    message+= '<dl>'
                    message+= '<dt>Successfully Deleted</dt>'
                    message+= '</dl></div>'
                    fetch_data();
                    $('.success').html(message);
                    
                },
                error(err){
                    console.log(err);
                    console.log('faild');
                    $('html, body').animate({scrollTop:0}, 'slow');
                    message = '<div class="alert error">'
                    message+= '<dl>'
                    message+= '<dt>something is wrong</dt>'
                    message+= '</dl></div>'
                    $('.error').html(message);
                }

            });
        }
        
        return false;
    });


	

//_________________________________________Pagination

$(document).on('click','.pagination a',function(event){
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    fetch_news(page);


});

function fetch_news(page){
    $.ajax({
        url:"/pagination?page="+page,
        success:function(data)
        {
        console.log('this is pagination');
         $('#table_data').html(data);
        },
        error(err){
        console.log('this is pagination');

            console.log(err);
            console.log('there is an error');
        }
       });

}

});

//  $(document).ready(function () {
  
// fetch_data();

 


// });
// ____________________Fetech Data and Search

// const ajaxTimeout = setTimeout(fetch_data, 100);
 function fetch_data(query=''){
    if(request){
        request.abort();
    }
    request = $.ajax({
        type:'get',
        url:'/ajaxIndex',
         dataType:'json',
        data:{query:query},
        // async:true,
        success:function(response){     
            console.log('hi');
             console.log(response);
                $('.list_news tbody').html(response.data); 
         },
         error(err){
             console.log('hello');
             console.log(err);
         }
         
     }).done(function(){
         request = null;
     });

    // ________________________Search 
  

 }

//  $(document).on('keyup','#search',function(){
//     var query = $(this).val();
//     console.log(query);
//    fetch_data(query);
//    console.log("here");
// });

$("#search" ).keyup(function() {
    var query=  $(this).val();
    fetch_data(query);
    
    
});



