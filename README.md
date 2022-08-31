Using Laravel nova, create a resource called "Patient".
Add the following fields and these fields should only be displayed when creating the form(All fleids are required):
Firstname - TextField
Lastname - TextField
BirthDate - DateField
Gender    - SelectField

Also, add a Panel called "Address" containing the following fields:
Street Address(Required) - TextField
City(Required) - TextField
State(Required) - SelectField(Containing about 10 states from Nigeria)
ZIP - TextField 


On the Patient Index, display the following columns
Name (Combination of Firstname & Lastname)
Burthdate
Gender
Created AT
