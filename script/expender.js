
// you can override default options globally, so they apply to every .expander() call
$.expander.defaults.slicePoint = 50;

$(document).ready(function() {
  

  // override default options (also overrides global overrides)
  $('div.expandable p').expander({
    slicePoint:       50,  // default is 100
    expandPrefix:     ' ', // default is '... '
    expandText:       '<br /> <br /> <div align="center"><button type="button" class="btn btn-success">Plus</button></div>', // default is 'read more'
    collapseTimer:    0, // re-collapses after 5 seconds; default is 0, so no re-collapsing
    userCollapseText: ' <br /> <br /> <div align="center"><button type="button" class="btn btn-danger">Moins</button></div>'  // default is 'read less'
  });

});