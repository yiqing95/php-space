初涉reactjs
==========

官网下载

>
    Note that React doesn’t impose any directory structure, you’re free to move to a different
    directory or rename react.js however you see fit.
    
开始了
~~~

    <!DOCTYPE html>
    <html>
    <head>
        <title>hello React</title>
        <meta charset="utf-8">
    </head>
    <body>
    <div id="app">
        <!-- my app renders here -->
    </div>
    <script src="../build/react.js"></script>
    <script>
        // my app's code
    </script>
    </body>
    </html>
~~~

两个注意点：  
 
>
       • you include the React library (<script src="react/build/react.js">)
       • you define where your application should be placed on the page (<div id="app">)
       
另：
>
   You can always mix regular HTML content as well as other Java‐
   Script libraries with a React app. You can also have several React apps
   on the same page. All you need is place in the DOM where you tell
   React: “do you magic right here”.
 
使用内置的dom：
>
   React.DOM.div(attributes, children)

规避一些js变量 做为属性：  
-  class            className
-  for              htmlFor

中划线分隔的属性：
>
    fontFamily as opposed to font-family.   

## 有等价的jsx语法   
   
创建组件
>
   var MyComponent = React.createClass({
   /* specs */
   });
最简单的例子
~~~
    
    var Component = React.createClass({
    render: function() {
    return React.DOM.span(null, "I'm so custom");
    }
    });
~~~

规范是一个json  唯一必须要实现的方法是render 方法，返回一个React组件。
>
        Using your component in an application is similar to using the DOM components:
        React.render(
        React.createElement(Component),
        document.getElementById("app")
        );
 
>        
        The React.createElement() is one way to create an “instance” of your component.
        Another way, if you’ll be creating several instances, is to create a factory:
        var ComponentFactory = React.createFactory(Component);
        React.render(
        ComponentFactory(),
        document.getElementById("app")
        );
        
        Note that the React.DOM.* methods you already know of are actually just convenience
        wrappers around React.createElement(). In other words, this code also works with
        DOM components:
        React.render(
        React.createElement("span", null, "Hello"),
        document.getElementById("app")
        );
        As you can see, the DOM elements are defined as strings as opposed to JavaScript
        functions as is the case with custom components.

Properties
Your components can take properties and render or behave differently, depending on
the values of the properties. All properties are available via this.props object. Let’s see
an example.
var Component = React.createClass({
render: function() {
return React.DOM.span(null, "My name is " + this.props.name);
}
});
Passing the property when rendering the component looks like:
React.render(
React.createElement(Component, {
name: "Bob"
}),
document.getElementById("app")
);
        
更新状态：
>
        The UI updates after calling setState() are done using a queuing
        mechanism that efficiently batches changes, so updating this.state
        directly can have unexpected behavior and you shouldn’t do it. Just
        like with this.props, consider the this.state object read-only, not
        only because it’s semantically a bad idea, but because it can act in ways
        you don’t expect.
        
Event delegation means you listen to events at some parent
node, say a <div> that contains many `<button>`s and setup one listener for all the
buttons.

~~~
    
    With event delegation you do something like
    <div id="parent">
    <button id="ok">OK</button>
    <button id="cancel">Cancel</button>
    </div>
    <script>
    document.getElementById('parent').addEventListener('click', function(event) {
    var button = event.target;
    // do different things based on which button was clicked
    switch (button.id) {
    case 'ok':
    console.log('OK!');
    break;
    case 'cancel':
    console.log('Cancel');
    break;
    default:
    new Error('Unexpected button ID');
    };
    });
    </script>

~~~
        