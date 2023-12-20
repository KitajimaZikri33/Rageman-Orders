import {
  initializeApp
} from "https://www.gstatic.com/firebasejs/10.6.0/firebase-app.js";
import {
  getDatabase,
  get,
  set,
  ref,
  push,
  child,
  onValue,
  update,
  remove
} from "https://www.gstatic.com/firebasejs/10.6.0/firebase-database.js";


// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyCl187TfdE2U96gwo_Wg7HToa0YmRV5wWk",
  authDomain: "rageman-orders.firebaseapp.com",
  databaseURL: "https://rageman-orders-default-rtdb.firebaseio.com",
  projectId: "rageman-orders",
  storageBucket: "rageman-orders.appspot.com",
  messagingSenderId: "998695493444",
  appId: "1:998695493444:web:a10201af4430f73e414111"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
console.log('Firebase initialized successfully!', app);
// Get a reference to the database service
const database = getDatabase(app);
