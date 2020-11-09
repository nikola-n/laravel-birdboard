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
- project_id 
- subject_id (task_id || project_id)
- subject_type (Task || Project model)
- description 
Morph one to many relationship for tasks

If we want to know what's changed we need to record model changes
