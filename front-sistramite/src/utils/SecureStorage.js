import { EncryptStorage } from "encrypt-storage";

// Example of secret_key variable in an .env file
// const encryptStorage = new EncryptStorage(process.env.SECRET_KEY, options);
export const secureStorage = new EncryptStorage(
  import.meta.env.VITE_APP_SECURE_KEY
);
