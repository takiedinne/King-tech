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

<ul class="nav nav-tabs nav-justified mb-3" id="ex1" role="tablist">
  <li class="nav-item" role="presentation">
    <a
      class="nav-link active"
      id="ex3-tab-1"
      data-bs-toggle="tab"
      href="#supply_tab"
      role="tab"
      aria-controls="supply_tab"
      aria-selected="true"
      >Supply</a
    >
  </li>
  <li class="nav-item" role="presentation">
    <a
      class="nav-link"
      id="ex3-tab-2"
      data-bs-toggle="tab"
      href="#selling_tab"
      role="tab"
      aria-controls="selling_tab"
      aria-selected="false"
      >Selling</a
    >
  </li>
  
</ul>

<div class="tab-content" id="ex2-content">
  <div
    class="tab-pane fade show active"
    id="supply_tab"
    role="tabpanel"
    aria-labelledby="ex3-tab-1"
  >
    Tab 1 content Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates, doloremque
    minima mollitia sapiente illo ut harum fugit explicabo error perspiciatis at cumque nisi eaque
    commodi culpa est sed ad amet.
  </div>
  <div class="tab-pane fade" id="selling_tab" role="tabpanel" aria-labelledby="ex3-tab-2">
    Tab 2 content Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates, doloremque
    minima mollitia sapiente illo ut harum fugit explicabo error perspiciatis at cumque nisi eaque
    commodi culpa est sed ad amet.
  </div>
  <div class="tab-pane fade" id="ex3-tabs-3" role="tabpanel" aria-labelledby="ex3-tab-3">
    Tab 3 content Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates, doloremque
    minima mollitia sapiente illo ut harum fugit explicabo error perspiciatis at cumque nisi eaque
    commodi culpa est sed ad amet.
  </div>
</div>
</body>
</html>
