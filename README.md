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

# Activity (Project Activity and Task Activity)
- project_id belongsTo
- description
