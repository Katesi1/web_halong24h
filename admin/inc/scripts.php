<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="scripts/toast.js"></script>
<script src="scripts/modal.js"></script>
<script src="scripts/sidebar.js"></script>

<script>
  // Set active navigation item
  function setActive() {
    let navbar = document.getElementById('dashboard-menu');
    if (!navbar) return;
    
    let a_tags = navbar.getElementsByTagName('a');

    for (let i = 0; i < a_tags.length; i++) {
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];

      if (document.location.href.indexOf(file_name) >= 0) {
        a_tags[i].classList.add('active');
      }
    }
  }
  
  // Initialize on DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setActive);
  } else {
    setActive();
  }
</script>
