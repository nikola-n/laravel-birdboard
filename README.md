# Project (hasMany Tasks)
- title
- description
- notes
- owner_id (User) belongsTo

#User (hasMany Projects)
- name
- email
- password

# Task (Project has tasks)
- project_id (Project) belongsTo
- body
- completed
