(function() {

  var app = angular.module("validation", ["ngMessages"]);

  var MyProfileController = function() {
    var model = this;

    model.message = "";

    model.user = {
      username: "",
      newpassword: "",
      confirmPassword: "",
      user_name:"",
      email:""
    };

    model.submit = function(isValid) {
      console.log("h");
      if (isValid) {
        model.message = "Submitted " + model.user.username;
      } else {
        model.message = "There are still invalid fields below";
      }
    };

    model.assignuser = function(username) {
      
      model.user.username = username;

    }; 

    model.assignuser_name = function(user_name) {
      
      model.user.user_name = user_name;

    }; 

    model.assignuseremail = function(email) {
      
      model.user.email = email;

    }; 

    
  };

  var compareTo = function() {
    return {
      require: "ngModel",
      scope: {
        otherModelValue: "=compareTo"
      },
      link: function(scope, element, attributes, ngModel) {

        ngModel.$validators.compareTo = function(modelValue) {
          return modelValue == scope.otherModelValue;
        };

        scope.$watch("otherModelValue", function() {
          ngModel.$validate();
        });
      }
    };
  };

 

  app.directive("compareTo", compareTo);
  app.controller("MyProfileController", MyProfileController);

}());