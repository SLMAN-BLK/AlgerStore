   
       function change(id, itemId) {
        var tdElement = document.getElementById(id);
        var buttonElement = tdElement.parentElement.querySelector('button');
    
        if (buttonElement.textContent === 'changer le prix') {
          console.log("ca entre")
            var currentPrice = tdElement.textContent.trim();
            tdElement.innerHTML = `<input type="number" id="input-${id}" value="${currentPrice}">`;
            buttonElement.textContent = 'valide le prix';
        } else {
            var newPrice = document.getElementById(`input-${id}`).value;
            window.location.href = `/validechangementdeprix/${itemId}?newPrice=${newPrice}`;
            
        }
    }
    function supp(id) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = `/supp/${id}`;
    
                // CSRF token
                var csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}'; // Laravel's CSRF token
    
                form.appendChild(csrfInput);
    
                document.body.appendChild(form);
                form.submit();
            }