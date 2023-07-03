package com.dwiki.satusehat.adapter

import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import com.dwiki.satusehat.model.responseModel.FasilitasRumahSakitItem
import com.dwiki.satusehat.databinding.ItemFasilitasRsBinding

class FasilitasAdapter(private var fasilitasRs:List<FasilitasRumahSakitItem>):RecyclerView.Adapter<FasilitasAdapter.ViewHolder>() {

    class ViewHolder (val binding:ItemFasilitasRsBinding):RecyclerView.ViewHolder(binding.root) {}

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): FasilitasAdapter.ViewHolder {
       val view = ItemFasilitasRsBinding.inflate(LayoutInflater.from(parent.context),parent,false)
        return ViewHolder(view)
    }

    override fun onBindViewHolder(holder: FasilitasAdapter.ViewHolder, position: Int) {
        holder.binding.tvNamaFasilitas.text = fasilitasRs[position].fasilitas.namaLayanan
        if (fasilitasRs[position].praktikPoli.isEmpty()){
            holder.binding.tvNamaDokter.text = "Tidak ada dokter"
            holder.binding.tvPraktik.text = "Tidak Ada Jam dan Hari Praktik"
        } else {
            val praktikPoli = fasilitasRs[position].praktikPoli[0]
            holder.binding.tvNamaDokter.text = praktikPoli.dokter.namaDokter
            holder.binding.tvPraktik.text = "Hari Praktik : ${praktikPoli.hariPraktik?: "-"}, Jam Buka: ${praktikPoli.jamPraktik?:"-"}"
        }

        if (fasilitasRs[position].fasilitas.antreanBpjs.size == 0 ){
            holder.binding.tvSelesai.text = "0"
        } else {
            val antreanBpjsSelesai = fasilitasRs[position].fasilitas.antreanBpjs[0].jumlahAntreanBpjsSelesai
            val totalBpjs = fasilitasRs[position].fasilitas.antreanBpjs[0].totalAntreanBpjs
            val sisaAntrean = totalBpjs - antreanBpjsSelesai
            holder.binding.tvSelesai.text =  sisaAntrean.toString()
        }

        if (fasilitasRs[position].fasilitas.antreanUmum.size == 0){
            holder.binding.tvSelesaiUmum.text = "0"
        } else{
            val antreanUmumSelesai = fasilitasRs[position].fasilitas.antreanUmum[0].jumlahAntreanUmumSelesai
            val totalUmum = fasilitasRs[position].fasilitas.antreanUmum[0].totalAntreanUmum
            val sisaUmum = totalUmum - antreanUmumSelesai
            holder.binding.tvSelesaiUmum.text = sisaUmum.toString()
        }

        holder.binding.btnDetailFasilitas.setOnClickListener {
            if (holder.binding.layoutBpjs.visibility == View.GONE && holder.binding.layoutUmum.visibility == View.GONE){
                holder.binding.layoutBpjs.visibility = View.VISIBLE
                holder.binding.layoutUmum.visibility = View.VISIBLE
            } else {
                holder.binding.layoutBpjs.visibility = View.GONE
                holder.binding.layoutUmum.visibility = View.GONE
            }
        }

    }



    override fun getItemCount(): Int  = fasilitasRs.size
}