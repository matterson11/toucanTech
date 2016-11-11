var app = angular.module('project', ['ngRoute'])

app.config(function($routeProvider) {
 
  $routeProvider
    .when('/', {
      controller:'membersController',
      templateUrl:'main_page.html'
    })
    .otherwise({
      redirectTo:'/'
    });
});
 
app.controller('membersController', 
  function(
  $location, 
  $scope, 
  $http,
  $timeout,
  $window){


// Add new member
  $scope.add_member = function (member)
  {
    $scope.formData = member;

    $http.post("php/new_member.php", {
      "name": $scope.formData.name,
      "email": $scope.formData.email,
      "school": $scope.formData.school
      }).success(function(response){
        alert('succesfully submitted');
        $window.location.reload();
      });
  };
  
  // Get list of schools
  $http.get("php/list_schools.php").then(function(response){
    $scope.schools_list = response.data.records;
  });

  $scope.member_school_list = 0;

  // Get members based on school
  $scope.search_members = function (id)
  {
    $scope.school_id = id;

    $http.post("php/search_members.php", {
      "id": $scope.school_id
    }).success(function(response){
      $scope.members_list = response.records;
      $scope.member_school_list = 1;
    });

  };

  // Get list of members
  $http.get("php/list_members.php").then(function(response){
    $scope.members_list = response.data.records;
  });

});
