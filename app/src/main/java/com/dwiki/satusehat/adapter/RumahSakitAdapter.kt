package com.dwiki.satusehat.adapter

import android.content.Intent
import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import com.bumptech.glide.Glide
import com.dwiki.satusehat.R
import com.dwiki.satusehat.model.responseModel.ListRumahSakitItem
import com.dwiki.satusehat.databinding.ItemRumahSakitBinding
import com.dwiki.satusehat.model.RumahSakit
import com.dwiki.satusehat.view.pendaftaran.PendaftaranAntreanActivity


class RumahSakitAdapter(private var listRs:List<ListRumahSakitItem>):RecyclerView.Adapter<RumahSakitAdapter.ViewHolder>() {



   inner class ViewHolder(val binding: ItemRumahSakitBinding):RecyclerView.ViewHolder(binding.root) {}

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
         val view = ItemRumahSakitBinding.inflate(LayoutInflater.from(parent.context),parent,false)
        return ViewHolder(view)
    }

    override fun getItemCount(): Int = listRs.size

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        holder.binding.tvNamaRs.text = listRs[position].nama
        holder.binding.tvLokasiRs.text = listRs[position].daerah.namaDaerah
        if (listRs[position].fotoRumahSakit != null){
            Glide.with(holder.itemView.context).load(listRs[position].fotoRumahSakit).fitCenter().into(holder.binding.ivProfileRumahSakit)
        } else {
            holder.binding.ivProfileRumahSakit.setImageResource(R.drawable.ic_no_image)
        }
        holder.binding.cvRs.setOnClickListener {
            val id = listRs[position].id
            val name = listRs[position].nama
            val daerah = listRs[position].daerah.namaDaerah
            val foto = listRs[position].fotoRumahSakit

            val rumahSakit = RumahSakit(id,name,daerah,foto)


            val intent = Intent(holder.itemView.context,PendaftaranAntreanActivity::class.java)
            intent.putExtra("data_rs",rumahSakit)
            holder.itemView.context.startActivity(intent)

        }


    }

    fun setData(newList:List<ListRumahSakitItem>){
        this.listRs = newList
    }
}