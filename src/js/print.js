function print_element($element_id = null) {
    if ($element_id == null) {
        // Alert Message when function was triggered without a element_id
        alert("No Element ID Selected");
    } else {
        // Cloning the specific element to print
        var el = $('#' + $element_id).clone()
            // removing the button incuded on the element
        el.find('button').remove()
            // cloning the element which contains the CSS for styling user-interface
        var head = $('head').clone()
            // creating a temporary container of the element to print
        var new_html = $('<html>')

        head.find('title').append(' - Print View')
            // adding the css to temporary container element
        new_html.append(head)
        new_html.append('<main></main>')
            // adding the element to temporary container element
        new_html.find('main').append(el)

        // Opening a new window (Pop-up) for the print view
        var new_window = window.open('', '_blank', 'location=no,width=900,height=700,left=250')
            // adding the content of temporary element to the new window
        new_window.document.write(new_html.html())
            // closing the new window document
        new_window.document.close()

        setTimeout(() => {
            // Trigger Print View
            new_window.print()
            setTimeout(() => {
                // Automatically closes the pop window after printing / canceling print view
                new_window.close()
            }, 200)
        }, 200);

    }
}