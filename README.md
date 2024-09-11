# Welcome to QRLA Platform

To install you must have: php composer node(and npm)

# Pages

The page structure is as follows:

In the pages directory, create a new directory for each page. For each page, create a main vue component and a sibling partials directory. In the partials directory, put all sub components for the
corresponding main vue component. The component doesn't have to be called main. E.g for the profile page: **Profile - directory name - contains:**

- Edit.vue
- Partials(directory) - contains:
  - deleteUserForm.vue
  - updatePwForm.vue
  - updateProfileInformation.vue
