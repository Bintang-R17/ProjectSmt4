document.addEventListener("DOMContentLoaded", function () {
  const btnAnalisis = document.getElementById("btnAnalisisAI");

  if (!btnAnalisis) return;

  btnAnalisis.addEventListener("click", async function () {
    const btnText = document.getElementById("btnText");
    const btnLoading = document.getElementById("btnLoading");
    const hasilCard = document.getElementById("hasilAnalisisCard");
    const hasilContent = document.getElementById("hasilAnalisisContent");
    const loadingOverlay = document.getElementById("loadingOverlay");
    const catatanTambahan = document
      .getElementById("catatanTambahan")
      .value.trim();

    // Ambil data yang ditanam dari PHP
    const pasienInfo = window.LAB_DATA?.pasienInfo || {};
    const parametersInfo = window.LAB_DATA?.parametersInfo || [];
    const hasil_lab_id = window.LAB_DATA?.hasilLabId;

    // Tampilkan loading
    btnText.classList.add("d-none");
    btnLoading.classList.remove("d-none");
    btnAnalisis.disabled = true;

    hasilCard.style.display = "block";
    loadingOverlay.classList.remove("d-none");

    try {
      // Susun prompt seperti sebelumnya
      let prompt = `Analisis hasil laboratorium pasien berikut:\n\n`;
      prompt += `INFORMASI PASIEN:\n`;
      prompt += `- Nama: ${pasienInfo.nama}\n`;
      if (pasienInfo.umur) prompt += `- Umur: ${pasienInfo.umur} tahun\n`;
      prompt += `- Jenis Pemeriksaan: ${pasienInfo.jenis_pemeriksaan}\n`;
      prompt += `- Tanggal: ${pasienInfo.tanggal_pemeriksaan}\n`;
      if (pasienInfo.catatan_lab)
        prompt += `- Catatan Lab: ${pasienInfo.catatan_lab}\n`;

      prompt += `\nHASIL LABORATORIUM:\n`;
      parametersInfo.forEach((param) => {
        const nilaiNormal =
          param.nilai_min && param.nilai_max
            ? `${param.nilai_min}-${param.nilai_max}`
            : "Tidak tersedia";
        prompt += `- ${param.nama_parameter}: ${param.nilai} ${param.satuan} (Normal: ${nilaiNormal}) - Status: ${param.status}\n`;
      });

      if (catatanTambahan) {
        prompt += `\nKELUHAN/PERTANYAAN TAMBAHAN:\n${catatanTambahan}\n`;
      }

      prompt += `\nMohon berikan analisis profesional yang mencakup:\n`;
      prompt += `1. Interpretasi hasil lab yang abnormal\n`;
      prompt += `2. Kemungkinan kondisi medis yang terkait\n`;
      prompt += `3. Rekomendasi tindakan medis lanjutan\n`;
      prompt += `4. Saran gaya hidup atau pencegahan\n`;
      prompt += `5. Tanda-tanda yang perlu diwaspadai\n\n`;
      prompt += `Gunakan bahasa Indonesia yang mudah dipahami dan sertakan disclaimer medis.`;

      const response = await fetch("analisis_ai.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          message: prompt,
          hasil_lab_id: hasil_lab_id,
          analysis_type: "comprehensive_lab_analysis",
          parameters_data: parametersInfo,
          patient_info: pasienInfo,
        }),
      });

      const responseText = await response.text();
      let data;

      try {
        data = JSON.parse(responseText);
      } catch (e) {
        throw new Error("Respons bukan JSON yang valid:\n" + responseText);
      }

      if (data.success && data.content) {
        const formattedContent = data.content
          .replace(/\n\n/g, "</p><p>")
          .replace(/\n/g, "<br>")
          .replace(/\*\*(.*?)\*\*/g, "<strong>$1</strong>")
          .replace(/\*(.*?)\*/g, "<em>$1</em>")
          .replace(/(\d+\.)/g, "<strong>$1</strong>");

        hasilContent.innerHTML = `
                    <div class="mb-3">
                        <h6 class="text-primary"><i class="fas fa-user-md"></i> Analisis Medis AI</h6>
                        <div class="border-start border-primary border-3 ps-3">
                            <p>${formattedContent}</p>
                        </div>
                    </div>
                    <hr>
                    <small class="text-muted">
                        <i class="fas fa-clock"></i> Dianalisis pada: ${
                          data.timestamp || new Date().toLocaleString("id-ID")
                        }
                    </small>
                `;
      } else {
        hasilContent.innerHTML = `
                    <div class="alert alert-warning">
                        <strong>Error:</strong> ${
                          data.error || "Tidak ada respons dari AI"
                        }
                    </div>
                `;
      }
    } catch (error) {
      hasilContent.innerHTML = `
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong> ${error.message}
                </div>
            `;
    } finally {
      loadingOverlay.classList.add("d-none");
      btnText.classList.remove("d-none");
      btnLoading.classList.add("d-none");
      btnAnalisis.disabled = false;
    }
  });
});
