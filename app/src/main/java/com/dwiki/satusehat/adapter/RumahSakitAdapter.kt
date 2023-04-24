package com.dwiki.satusehat.adapter

import android.view.LayoutInflater
import android.view.ViewGroup
import android.widget.Toast
import androidx.recyclerview.widget.AsyncListDiffer
import androidx.recyclerview.widget.DiffUtil
import androidx.recyclerview.widget.RecyclerView
import com.bumptech.glide.Glide
import com.dwiki.satusehat.R
import com.dwiki.satusehat.data.responseModel.ListRumahSakitItem
import com.dwiki.satusehat.databinding.ItemRumahSakitBinding


class RumahSakitAdapter(private var listRs:List<ListRumahSakitItem>):RecyclerView.Adapter<RumahSakitAdapter.ViewHolder>() {



    class ViewHolder(val binding: ItemRumahSakitBinding):RecyclerView.ViewHolder(binding.root) {}

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
            val name = listRs[position].nama
            Toast.makeText(holder.itemView.context, "Kamu memilih $name", Toast.LENGTH_SHORT).show()
        }


    }

    fun setData(newList:List<ListRumahSakitItem>){
        this.listRs = newList
    }
}