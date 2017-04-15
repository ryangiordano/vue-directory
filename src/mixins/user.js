import {
    eventBus
} from '../main';
export const UserHttp = {
    data() {
        return {}
    },
    methods: {
        login() {
            return new Promise((resolve, reject) => {
                let formData = new FormData();
                formData.append('email', this.user.email);
                formData.append('password', this.user.password);

                this.$http.post('http://localhost/api/routes/auth/login.php',
                    formData, {
                        emulateJSON: true
                    }).then(response => {
                    if (response.status == 204) { //wrong password
                        eventBus.$emit('alert', {
                            message: "email or password is incorrect",
                            color: '#e26868'
                        });
                    } else { //successful
                        this.user.email = '';
                        this.user.password = '';
                        // console.log(response);

                        let responseObj = JSON.parse(response.bodyText);
                        localStorage.setItem("token", responseObj.jwt);
                        this.getUser();
                        this.$store.dispatch('login', true);

                        eventBus.$emit('alert', {
                            message: 'Successfully logged in',
                            color: '#85c151'
                        });
                        this.$router.push({
                            path: '/home'
                        })
                    }
                })
            });
        },
        logout() {
            this.$store.dispatch('login', false);//set login to false
            this.$store.dispatch('setUser',{});//clear the locally stored user object
            localStorage.clear();//clear the token from local storage
            eventBus.$emit('loggedOut', true);
            eventBus.$emit('alert', {
                message: 'Successfully logged out',
                color: '#85c151'
            });

            this.$router.push({
                path: '/login'
            })
        },
        getUser() {
            let formData = new FormData();
            formData.append('token', localStorage.getItem('token'));
            formData.append('decodeToken', true);
            this.$http.post('http://localhost/api/routes/auth/get-post-user.php',
                formData, {
                    emulateJSON: true
                }).then(response => {
                console.log(response);
                if (response.status == 204) { //wrong password
                    eventBus.$emit('alert', {
                        message: "An error Occurred",
                        color: '#e26868'
                    });
                } else { //successful
                    let responseObj = JSON.parse(response.bodyText);
                    this.$store.dispatch('setUser', responseObj);
                }
            })
        },
        getUsers() {

        },
        deleteUser() {

        },
        editUser() {

        }
    }
}
