$(function() {
    console.log("starting")
    var $users_drop = $('#user_menu');
    
    var $xhr = $.ajax({
        url: 'http://localhost/ChatKit/listinfo.php',
        dataType: 'JSON',
        type: 'GET',
    })
    
    .done(function(result){
        
        users = result['users'];
        console.log(users);
        $.each(users, function(i, user){
            $users_drop.append('<option class="form-control" value=' + user.id + '>' + user.name + '</option>');
        })
        
    })
})