/**
 * Handle API errors with user-friendly messages
 */
function handleError(error) {
  let message = "Terjadi kesalahan tidak diketahui";

  if (error instanceof Error) {
    if (error.message.includes("Failed to fetch")) {
      message =
        "Tidak dapat terhubung ke server. Periksa koneksi internet Anda.";
    } else if (error.message.startsWith("HTTP")) {
      message = "Terjadi kesalahan pada server: " + error.message;
    } else {
      message = error.message;
    }
  } else if (typeof error === "string") {
    message = error;
  }

  console.error("Error handled by ApiClient:", message);
  return message;
}
