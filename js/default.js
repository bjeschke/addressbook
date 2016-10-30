
function loadUserDetail(object) {
	var id = $('#'+ object.id +' .userid').html();

  $.ajax({
    type: "POST",
    url: "callback/load_detail.php",
    data: {id:id}
      }).done(function( msg ) {
        if(msg)
        {
        	var user = JSON.parse(msg);

					$('#detail_firstname').html(user.firstname);
					$('#detail_lastname').html(user.lastname);
					$('#detail_number').html(user.number);
					$('#detail_street').html(user.street);
					$('#detail_suburb').html(user.suburb);
					$('#detail_state').html(user.state);
					$('#detail_id').html(user.id);
					
					$('.userdetail dl').show();
					$('.userdetail button').show();
        }
    });
}

function loadUserOverview(id) {
	var page = id.replace('page','');

  $.ajax({
    type: "POST",
    url: "callback/load_overview.php",
    data: {page:page}
      }).done(function( msg ) {
        if(msg)
        {
        	var user = JSON.parse(msg);

        	for(var i=0;i<5;i++)
        	{
        		$('.user .firstname').empty();
        		$('.user .lastname').empty();
        		$('.user .userid').empty();
        	}
        	        	
        	i = 1;
        	for(var name in user)
        	{
						$('#user' + i + ' .firstname').html(user[name].firstname);
						$('#user' + i + ' .lastname').html(user[name].lastname);
						$('#user' + i + ' .userid').html(user[name].id);
						i++;
					}		
					
					$('.changepage').removeClass('active');
					$('#page'+ page).addClass('active');
        }
    });
}

function getUserAmount() {
  $.ajax({
    type: "POST",
    url: "callback/load_useramount.php",
    data: {}
      }).done(function( msg ) {
        if(msg)
        {
        	var userAmount = JSON.parse(msg);

					for(i = 1;i< Math.ceil(userAmount/5)+1;i++) {
						$('#pagnation').append('<div class="changepage" id="page'+i+'" onclick="loadUserOverview(this.id)">'+i+'</div>');
					}	
        }
    });
}

function deleteUser(id) {
  $.ajax({
    type: "POST",
    url: "callback/delete_user.php",
    data: {id:id}
      }).done(function( msg ) {
        if(msg)
        {
        	var user = JSON.parse(msg);
        	
        	/* TODO */
        }
    });
}

function updateUser() {
	var firstname = $('#edit_firstname').val();
  var lastname = $('#edit_lastname').val();
  var number = $('#edit_number').val();
  var street = $('#edit_street').val();
  var suburb = $('#edit_suburb').val();
  var state = $('#edit_state').val();
  var id = $('#detail_id').html();
  	
  $.ajax({
    type: "POST",
    url: "callback/update_user.php",
    data: {id:id,firstname:firstname,lastname:lastname,number:number,street:street,suburb:suburb,state:state}
      }).done(function( msg ) {
        if(msg)
        {
        	var user = JSON.parse(msg);

        	$('#detail_firstname').html(user.firstname);
					$('#detail_lastname').html(user.lastname);
					$('#detail_number').html(user.number);
					$('#detail_street').html(user.street);
					$('#detail_suburb').html(user.suburb);
					$('#detail_state').html(user.state);
					$('#detail_id').html(user.id);
					
					closeUserDetailLayer(); 
        }
    });
}

function closeUserDetailLayer() {
	$('#bg_layer').hide();
	$('#userdetaillayer').hide();
}

function openUserDetailLayer() {
  var tTop = ($(window).height() - $('#userdetaillayer').height()) / 2;
  var tLeft = ($(window).width() - $('#userdetaillayer').width()) / 2;
  
  $('#edit_firstname').val($('#detail_firstname').html());
  $('#edit_lastname').val($('#detail_lastname').html());
  $('#edit_number').val($('#detail_number').html());
  $('#edit_street').val($('#detail_street').html());
  $('#edit_suburb').val($('#detail_suburb').html());
  $('#edit_state').val($('#detail_state').html());
  
  $('#bg_layer').css({width:$(document).width(),height:$(document).height()});
  $('#bg_layer').fadeIn('slow');
  $('#userdetaillayer').css({top:tTop,left:tLeft});
  $('#userdetaillayer').fadeIn('slow');
}

$(document).ready(function(){
	$('#userdetail').hide();
	$('.user').click(function(){loadUserDetail(this);});
	$('#userdetaillayer #close_button').click(function(){closeUserDetailLayer();});
		
	$('#edit_button').click(function(){openUserDetailLayer();});
	$('#delete_button').click(function(){/* TODO */});
	$('#save_button').click(function(){updateUser()});
	
	loadUserOverview('page1');
	getUserAmount();
});

