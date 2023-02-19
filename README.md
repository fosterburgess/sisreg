# sisreg


## model/structure

### student
### guardian
### teacher
### org-admin
### school
### org
### course (spanish 1)
### timeperiods (semesters, etc)
### instance (class)
### section
### registration


## Feb 12, 2023
Create some initial tests

* create user(s)
* create multi level org - state, county, district, school
* create teacher
* create students
* create guardians
* create course
* create time periods
* create instances
* create sections
* create registration (lots of work there)

## Feb 19, 2023

What tests can we put together?

Can a teacher be associated with more than one school?
Relation between teacher/student/school:

Teacher is assigned to multiple instances (basically a class).

Multiple teachers may be able to be associated 
with a specific instance (support multiple teachers 
having access to same class - substitutes, trainee teachers, etc).

Instance/class is associated with a school.

A teacher 'teaching' at only one school will have only 
one unique school ID for all classes they teach.

Teacher teaching generic 'virtual' class - instance may 
not be associated with any particular school.  Students 
from multiple schools may be in one virtual class.

There are situations where class instances need to be associated 
with one particular school at a time for record keeping 
and possible accounting purposes.

We still do need a 'current school id' on a teacher 
record, which keeps track of main school association.  

A separate list of schools a teacher is allowed access to 
to should be kept as a many many relationshop - org_teacher or 
similar (will look at later).

TEST:
Create teacher as super admin (any or no school)
Create teacher as org admin(?)
