import {
    eventBus
} from '../main';
export const EmployeeHttp = {
    data() {
        return {}
    },
    methods: {

        getEmployee(id) {
            this.$http.get(`http://localhost/api/routes/employees/get-post.php?getOne=true&id=${id}`)
                // this.$http.get('http://localhost/api/routes/employees/get-post.php')
                .then(response => {
                    if (response.ok) {
                        if (response.status == 204) {
                            return console.log("No employees found");
                            this.employeesMessage = "No employees found.";
                        }

                        this.employee = JSON.parse(response.bodyText);
                    } else {
                        console.error(response.statusText);

                    }

                })
        },
        getEmployees() {
            // this.$http.get('http://www.gocodigo.com/temporarypages/giordano/vue-directory/api/routes/employees.php')
            this.$http.get('http://localhost/api/routes/employees/get-post.php')
                // this.$http.get('http://localhost/api/routes/employees/get-post.php')
                .then(response => {
                    if (response.ok) {
                        if (response.status == 204) {
                            return console.log("No employees found");
                            this.employeesMessage = "No employees found.";
                        }
                        this.employees = JSON.parse(response.bodyText);

                    } else {
                        console.error(response.statusText);

                    }

                })
        },
        deleteEmployee(employee) {
            let formData = new FormData();
            formData.append('id', employee.id);
            formData.append('img',employee.img);
            this.$http.post('http://localhost/api/routes/employees/delete.php', formData, {
                    emulateJSON: true,
                })
                .then(response => {
                    if (response.ok) {
                      console.log(response);
                        console.log("Employee removed successfully");
                    } else {
                        console.error('there was an error')
                    }
                })
        },
        editEmployee() {
            let formData = new FormData();
            formData.append('id', this.employee.id);
            let token = localStorage.getItem('token');
            formData.append('token', token);
            formData.append('branchId', this.employee.branchId);
            formData.append('phone', this.employee.phone);
            formData.append('email', this.employee.email);
            formData.append('title', this.employee.title);
            formData.append('firstName', this.employee.firstName);
            formData.append('lastName', this.employee.lastName);
            formData.append('about', this.employee.about);
            formData.append('img', this.employee.img);
            this.$http.post('http://localhost/api/routes/employees/edit.php', formData, {
                    emulateJSON: true,
                })
                .then(response => {
                  console.log(response);
                    if (response.ok) {
                      eventBus.$emit('alert', {
                          message: 'Employee edited successfully',
                          color: '#85c151'
                      });

                    } else {
                        console.error('there was an error')
                    }
                })
        },
        addEmployee() {

        }
    }
}
