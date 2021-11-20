import ImageKit from "imagekit-javascript";

const publicKey = "public_Fcz/M8ZbupZNL5K8P3WMz02R7uI=";
const urlEndpoint = "https://ik.imagekit.io/hoangtrung070801";
const authenEndpoint = "http://localhost:8080//image/load";

/**
 * Upload image to third party image hosting server ImageKit
 *
 * @param file: File
 * @param fileName: string
 * @param onReceive: (value: string) => { this.someVariable = value; }
 */
export const uploadImage = (file, fileName, onReceive) => {
    var imagekit = new ImageKit({
        publicKey : publicKey,
        urlEndpoint : urlEndpoint,
        authenticationEndpoint : authenEndpoint
    });

    imagekit.upload({
        file : file,
        fileName : fileName,
        tags : ["default"]
    }, function(err, result) {
        onReceive(imagekit.url({
            src: result.url
        }));
    })
}