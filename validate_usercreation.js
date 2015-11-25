function validate_usercreation(form)
      {
        fail  = validateCustomerFName(form.customer_fname.value)
        fail += validateCustomerLName(form.customer_lname.value)
        fail += validateCustomerEmail(form.customer_email.value)
        fail += validateCustomerPhone(form.customer_phone.value)
        fail += validateCustomerUsername(form.username.value)
        fail += validateCustomerPassword(form.customer_password.value)

        if   (fail == "")   return true
        else { alert(fail); return false }
      }

      function validateCustomerFName(field)
      {
        return (field == "") ? "Please enter First Name.\n" : ""
      }
      
      function validateCustomerLName(field)
      {
        return (field == "") ? "Please enter Last Name.\n" : ""
      }

      function validateCustomerUsername(field)
      {
        if (field == "") return "Please enter Username.\n"
        else if (field.length < 6)
          return "Usernames must be at least 6 characters.\n"
        else if (/[^a-zA-Z0-9_-]/.test(field))
          return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n"
        return ""
      }

      function validateCustomerPassword(field)
      {
        if (field == "") return "No Password was entered.\n"
        else if (field.length < 6)
          return "Passwords must be at least 6 characters.\n"
        else if (! /[a-z]/.test(field) ||
                 ! /[A-Z]/.test(field) ||
                 ! /[0-9]/.test(field))
          return "Passwords require one each of a-z, A-Z and 0-9.\n"
        return ""
      }

      function validateCustomerPhone(field)
      {
        if (isNaN(field)) return "Please enter Phone Number.\\n"
        else if (field.length < 10)
          return "Please enter full 10 digit Phone Number.\n"
        return ""
      }

      function validateCustomerEmail(field)
      {
        if (field == "") return "Please enter Email Address.\n"
          else if (!((field.indexOf(".") > 0) &&
                     (field.indexOf("@") > 0)) ||
                     /[^a-zA-Z0-9.@_-]/.test(field))
            return "The Email address is invalid.\n"
        return ""
      }
