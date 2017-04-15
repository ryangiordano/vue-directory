import {
    eventBus
} from '../main';
export const EmployeeHttp = {
    data() {
        return {}
    },
    methods: {

        getEmployee() {
        },
        getEmployees() {
          // this.$http.get('http://www.gocodigo.com/temporarypages/giordano/vue-directory/api/routes/employees.php')
          this.$http.get('http://localhost/api/routes/employees/get-post.php')
              // this.$http.get('http://localhost/api/routes/employees/get-post.php')
              .then(response => {
                  if (response.ok) {
                    if(response.status == 204){
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
          this.$http.post('http://localhost/api/routes/employees/delete.php', formData, {
                  emulateJSON: true,
              })
              .then(response => {
                  if (response.ok) {
                      console.log("Employee removed successfully");
                  } else {
                      console.error('there was an error')
                  }
              })
        },
        editEmployee(){

        }
    }
}
