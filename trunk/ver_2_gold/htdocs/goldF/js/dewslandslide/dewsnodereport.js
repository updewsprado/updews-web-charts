/**
 * @author PradoArturo
 */

angular.module('modalTest', [
    'ui.bootstrap',
    'dialogs'
]).controller('dialogServiceTest', function ($scope, $rootScope, $timeout, $dialogs) {
    $scope.confirmed = 'You have yet to be confirmed!';
    $scope.name = '"Your name here."';
    $scope.launch = function (which) {
        var dlg = null;
        switch (which) {
        case 'create':
            dlg = $dialogs.create('/dialogs/whatsyourname.html', 'whatsYourNameCtrl', {}, {
                key: false,
                back: 'static'
            });
            dlg.result.then(function (name) {
                $scope.name = name;
            }, function () {
                $scope.name = 'You decided not to enter in your name, that makes me sad.';
            });
            break;
        };
    };
}).controller('whatsYourNameCtrl', function ($scope, $modalInstance, data) {
    $scope.user = { name: '' };
    $scope.cancel = function () {
        $modalInstance.dismiss('canceled');
    };
    $scope.save = function () {
        $modalInstance.close($scope.user.name);
    };
    $scope.hitEnter = function (evt) {
        if (angular.equals(evt.keyCode, 13) && !(angular.equals($scope.name, null) || angular.equals($scope.name, '')))
            $scope.save();
    };
});
