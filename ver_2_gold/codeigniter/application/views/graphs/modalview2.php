<!doctype html>
<html ng-app="plunker">
  <head>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.js"></script>
    <script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.6.0.js"></script>
    <script src="/temp/example.js"></script>
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
  </head>
  <body>

<div ng-controller="ModalDemoCtrl">
    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3>I'm a modal!</h3>
        </div>
        <div class="modal-body">
            <ul>
                <li ng-repeat="item in items">
                    <a ng-click="selected.item = item">{{ item }}</a>
                </li>
            </ul>
            Selected: <b>{{ selected.item }}</b>
            
            <p>Input something in the input box:</p>
			<p>Name: <input type="text" ng-model="node" value="John"></p>
			Name: <b>{{ node }}</b>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" ng-click="ok()">OK</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
    </script>

    <button class="btn" ng-click="open()">Open me!</button>
    <div ng-show="selected">Selection from a modal: {{ selected }}</div>
    <div ng-model="node">Name: {{ node }}</div>
</div>
  </body>
</html>