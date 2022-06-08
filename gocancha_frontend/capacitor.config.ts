import {CapacitorConfig} from '@capacitor/cli';

const capacitorConfig: CapacitorConfig = {
  appId: 'com.gocancha.app.cliente',
  appName: 'GoCancha',
  bundledWebRuntime: false,
  webDir: 'www',
  plugins: {
    GoogleAuth: {
      scopes: ["profile", "email"],
      serverClientId: "853366195872-rt7igti02ul2igknoa7v8c65fjufm826.apps.googleusercontent.com",
      forceCodeForRefreshToken: true
    }
  },
  ios: {
    scheme: 'xcodebuild -workspace ios/App/App.xcworkspace -list'
  }
};

export default capacitorConfig;
