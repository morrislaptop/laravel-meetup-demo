<template>
    <div>
        <h1>All Bookings ordered by cost greater than 10</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>When</th>
                    <th>Where</th>
                    <th>Status</th>
                    <th>Cost</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="booking in bookings" :key="booking.name">
                    <th>{{ booking.name }}</th>
                    <td>{{ booking.when }}</td>
                    <td>{{ booking.where }}</td>
                    <td>{{ booking.status }}</td>
                    <td>{{ booking.cost }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    var firebase = require('firebase')

    var firebaseApp = firebase.initializeApp({
        apiKey: "AIzaSyAWvZ8YXAsdLqi5InT_yj7gyfttQ5Np4XU",
        authDomain: "laravel-meetup-demo.firebaseapp.com",
        databaseURL: "https://laravel-meetup-demo.firebaseio.com",
        projectId: "laravel-meetup-demo",
        storageBucket: "laravel-meetup-demo.appspot.com",
        messagingSenderId: "712900540679"
    })
    var db = firebaseApp.database()

    export default {
        firebase: {
            bookings: db.ref('bookings').orderByChild('cost').startAt(11),
        }
    }
</script>
