import { Injectable } from '@angular/core';
import { Directory, Filesystem } from '@capacitor/filesystem';

const CACHE_FOLDER = 'CACHED-IMG';

@Injectable({
    providedIn: 'root'
})

export class FileUtils {
    public static async storeImageCloudinary(publicId, path) {
        const response = await fetch('https://res.cloudinary.com/gocancha/image/upload/c_scale,h_200,w_200/v1/' + publicId + '.webp');
        const blob = await response.blob();
        const base64Data = await this._convertBlobToBase64(blob) as string;

        return await Filesystem.writeFile({
            path: `${CACHE_FOLDER}/${path}`,
            data: base64Data,
            directory: Directory.Cache
        });
    }

    private static _convertBlobToBase64(blob: Blob) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader;
            reader.onerror = reject;
            reader.onload = () => {
                resolve(reader.result);
            };
            reader.readAsDataURL(blob);
        });
    }
}
