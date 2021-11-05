Explanation of Web Application:

I believe my application manages to achieve the specification listed in the coursework.I have made use of a header, which appears on all pages, that 
allows the user to navigate to various pages as well as logout. The 'Create Account' page allows the user to create an account and select the option 
as to choose whether to join or create a household group. My application supports multiple households, more detail on this later.

Depending on whether the user wants to join or create a new household group, they will be redirected to either a 'Join Chore Group'
or 'Create Chore Group' page. The form on each of these pages (including the login) use Javascript to make sure the details in the form
submitted is valid. Valid forms include, mostly non-empty names/passwords however the email input field will also make sure that
the entered email must have an '@' character. The 'Create Account' and 'Create Chore Group' forms will print error messages under the
particular fields which contain errors. However the 'Login' and 'Join Chore Group' will simply return one error message if the form
is not valid (This is for security reasons, otherwise the errors could help hackers narrow down which fields are correct and which aren't).

Creating a chore group is very similar to creating an account, but only requres a name and password. Any accounts being made for the
first time have the option to join/create a chore group of their choosing. Once the user has made an account and joined/created a household,
they will redirected to the main page: 'chores.php'. This page contains the active, upcoming and completed chores of the user as well as
details of chores that other housemates in that particular household have.

The user has the option to add a chore to the list of chores for the household via the big green add button at the top of the page, below the welcome
message. To declutter the page, this add button redirects the user to a form where they can fill in various details about the chore they want to add such
as whether to send the person doing the chore an email notification or not. 

In order to improve accessibility for disabled users, I have used four distinct colours across all pages of my web application. These colours where 
specifically chosen not only because they are (in my opinion) attractive colours (so user experience is improved), but also users with 
deuteranomaly or protanomaly (red-green colour blindness) can still easily differentiate between the colours (I tested this with one of my colour blind friends).
Other features that improve the usability and accessibility of the application are the fact the buttons, such as the add chore button or the buttons in the
header, are large and distinctive. Hovering over them will change the cursor shape as well as the background colour of the button. Furthermore for the Add chore
and back button I have used symbols that are universally associated with adding and going back (a plus sign and a back arrow). Furthermore, hovering over these
two buttons will cause the page to display "Add New Chore" or "Back" right under the button for even more clarity for disabled users.

-------------------------------------------------------------------------------------------------------------------------------------------------------

To maximise the security of the page I have done the following:

- I have used the 'htmlspecialchars()' function on any parts of the page that can be affected by the user. This prevents Cross-Site-Scripting (XSS).
- I have prevented SQL injection on all inputs possible by the user using the 'bindValue()' function.
- I have included a 'loggedIn' check on each page specific to a household, to make sure the current user is logged in, otherwise if they aren't, they will
  be redirected back to the login page.
- I have also included a check on each page to make sure that the logged in user has permission to view the page. For example, without this, a user could
  log into their own household chore page, change the URL to and then view the chores of another household. This could also be done when adding a chore i.e.
  a chore could be added to another household simply by changing the url. The check I have included makes sure that the user can only access pages associated with
  with their household, otherwise they will be redirected back to the login page.

To improve the user experience, as well as the various things mention above, I have also included some AJAX to the main page so that a user can
simply click their chore to mark it as complete, or if the chore is 'upcoming', clicking it will result in it being made into an active chore (which they can later
click to complete the chore). Other uses of javascript include improving the usability and apperance of buttons, headers etc. I purposefully did not add the 'Add chore'
form onto the main page because it would become too cluttered and ugly. Having a seperate page was far more logical and provided an easier user exprience in my opinion. 

-------------------------------------------------------------------------------------------------------------------------------------------------------

Chore Allocation Strategy:

I decided to not use the two allocations suggested in the coursework briefing. Instead I decided to add a 'difficulty' characteristic to each chore in the household.
There are three possible difficulties: Easy, Medium and Hard (Worth 1, 2 and 3 units of difficulty respectively). The chore would be allocated to the user with the
least 'workload', for example a user with 2 Hard chores would receive a chore over a user with 4 Medium chores. So the 'workload' is simply the sum of the difficulties
of each chore a particular user has. This ensures that at all times, all members of a particular household have a similar amount of chores to do in terms of total difficulty. 
Once a chore has been allocated, the user's workload updates to 'workload + difficulty(New Chore)'. For example, a user with 3 Medium chores and 2 Easy chores would have 
a workload of 8. If they were allocated a Hard chore, their workload would then become 11.

I have purposefully made completing a chore NOT reduce the workload because if a household member completes chores as soon as they get them, they will constantly have 
a low 'workload' i.e. they will always be the one receiving new chores. Compare this to a member who's slow at completing chores; they won't be receiving new chores meaning 
the first user will be doing far more work and hence this would be an unfair allocation strategy. Both users will receive a fair amount of chores and ensure they are doing
an equal amount of work.

-------------------------------------------------------------------------------------------------------------------------------------------------------
Additional Features:

The main additional features my program includes are the following:

- Securely supports multiple households, not just one.

    As mentioned above, you have the choice upon sign-up to join an existing house or to create a new one.

- The ability to send email notifications receiver of the chore.

    I was going to make the application always send email notifications, however from testing on my own inbox, I found this wasn't clever
    so I made it an optional ability when adding a chore to a household.

- The ability to make an upcoming chore, an active chore.

    I was slightly confused by the coursework briefing as to if it was even necessary to include upcoming chores or not. I decided to include
    them, as well as have the option to make them active chores (simply by clicking the chore).

- Other smaller features that improve the user experience (e.g. Difficulty of a chore for fairer allocation, the date the chore was created etc.).

Hopefully you will enjoy your experience using The Chorinator 3000. :)