// This file can be replaced during build by using the `fileReplacements` array.
// `ng build --prod` replaces `environment.ts` with `environment.prod.ts`.
// The list of file replacements can be found in `angular.json`.

export const environment = {
  production: false,
  REMOTE_API_URI: 'http://10.45.1.171:8081/api/rest/',
  REMOTE_PUBLIC_URI: 'http://10.45.1.171:8081/public/rest/',
  CDN_CLOUDINARY: 'https://api.cloudinary.com/v1_1/gocancha/image/upload',
  CDN_CLOUD_NAME_CLOUDINARY: 'gocancha',
  API_KEY_GOOGLE_MAPS: 'AIzaSyA7oWiXT3LC-qlx3myEP-dH1R18Ez7BDNY',
  API_KEY_FACEBOOK: '1481746205367224',
  API_KEY_GOOGLE: '943808959182-g09b041ltr8u77aq65a9bsnlmfh0nl4o.apps.googleusercontent.com',
  API_KEY_GOOGLE_AUTH: '853366195872-vf1gvmpbplcbm4koe1q69lga0qeh5jki.apps.googleusercontent.com',
  firebaseConfig: {
    apiKey: "AIzaSyAoYqziOD7yAPH_YwcfHN4Z1aaNSO-9a94",
    authDomain: "gocanchaapp-3ed39.firebaseapp.com",
    projectId: "gocanchaapp-3ed39",
    storageBucket: "gocanchaapp-3ed39.appspot.com",
    messagingSenderId: "853366195872",
    appId: "1:853366195872:web:fbe4831eaba910ea1cabc5",
    measurementId: "G-BYV93KD06E"
  }
};

/*
 * For easier debugging in development mode, you can import the following file
 * to ignore zone related error stack frames such as `zone.run`, `zoneDelegate.invokeTask`.
 *
 * This import should be commented out in production mode because it will have a negative impact
 * on performance if an error is thrown.
 */
// import 'zone.js/plugins/zone-error';  // Included with Angular CLI.
