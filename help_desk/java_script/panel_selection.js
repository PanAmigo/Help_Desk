function showAdmin() {
    var userDiv = document.querySelector('.user');
    var adminDiv = document.querySelector('.admin');
    
    userDiv.style.display = 'none';
    adminDiv.style.display = 'block';
};
function showUser() {
    var userDiv = document.querySelector('.user');
    var adminDiv = document.querySelector('.admin');
    
    userDiv.style.display = 'block';
    adminDiv.style.display = 'none';
};
function show_users() {
    var usersDiv = document.querySelector('.users_all');
    var companyDiv = document.querySelector('.company');
    
    usersDiv.style.display = 'block';
    companyDiv.style.display = 'none';
};
function show_company() {
    var usersDiv = document.querySelector('.users_all');
    var companyDiv = document.querySelector('.company');
    
    usersDiv.style.display = 'none';
    companyDiv.style.display = 'block';
};

$(document).ready(function(){
    $("#new_client").click(function(){
        $("#myModal").modal();
    });
});