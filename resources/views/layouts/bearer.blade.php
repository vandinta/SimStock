<script>
  function getCookie(name) {
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
      const cookie = cookies[i].trim();
      if (cookie.startsWith(name + '=')) {
        return cookie.substring(name.length + 1, cookie.length);
      }
    }
    return null;
  }

  const token = getCookie("access_token");
  
  console.log(token);// Replace with your actual Bearer token

  const requestOptions = {
    method: 'GET', // Specify the HTTP method (e.g., GET, POST, etc.)
    headers: {
      'Authorization': `Bearer ${token}`, // Set the Bearer token in the Authorization header
    },
  };
</script>