<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Popover Example</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

  <button id="btn1" onclick="myfun()" class="btn btn-primary">Click me</button>

  <script>
    function myfun() {
     
      
      var btn = $("#btn1");
      alert('togglePopover');
      // Get or create a popover instance
      var popover = bootstrap.Popover.getOrCreateInstance(btn, {
        container: 'body',
        title: '<h4 class="custom-title"><i class="fas fa-warning"></i> Are you sure ?<button  > xxxx </button> </h4>',
        content: '<div class="popover-content text-center">' +
            '<div class="btn-group">' +
            '<a class="btn btn-sm btn-primary confirm_delete_item" ><i class="fas fa-check"></i> Yes</a>' +
            '<a class="btn btn-sm btn-danger cancel_delete_item"><i class="fas fa-times"></i> No</a>' +
            '</div>' +
            '</div>',
        html: true,
      });

      popover.show();
      
    };
  </script>

</body>
</html>
